<?php
class rex_email_obfuscator {
	public static function obfuscate($ep) {
		$content = $ep->getSubject();
		$whitelistTemplates = rex_addon::get('email_obfuscator')->getConfig('templates', []);
		$whitelistArticles = rex_addon::get('email_obfuscator')->getConfig('articles', '');

		if ($whitelistArticles != '') {
			$whitelistArticles = explode(',', $whitelistArticles);
		} else {
			$whitelistArticles = [];
		}

		if (!is_null(rex_article::getCurrent()) && !in_array(rex_article::getCurrent()->getTemplateId(), $whitelistTemplates) && !in_array(rex_article::getCurrentId(), $whitelistArticles)) {
			$javascriptmethod = rex_addon::get('email_obfuscator')->getConfig('javascriptmethod');
			$nojavascriptmethod = rex_addon::get('email_obfuscator')->getConfig('nojavascriptmethod');
			$atPos = strpos($content, '@');
	
			if ($atPos === false || (!$javascriptmethod && !$nojavascriptmethod)) {
				// nothing to do
				return $content;
			}
	
			// wrap anchor tag around email-adresses that don't have already an anchor tag around them
			$content = self::makeEmailClickable($content);
	
			// replace all email addresses (now all wrapped in anchor tag) with spam aware version
			$content = preg_replace_callback('`\<a([^>]+)href\=\"mailto\:([^">]+)\"([^>]*)\>(.*?)\<\/a\>`ism', function ($m) {
				return self::encodeEmail($m[2], $m[4], $m[1], $m[3]);
			}, $content);
		
		}
	
		// done!
		return $content;
	}

	public static function encodeEmail($email, $text = "", $attributesBeforeHref = '', $attributesAfterHref = '') {
		if (empty($text)) {
			$text = $email;
		}

		$attributesBeforeHref = trim($attributesBeforeHref);
		$attributesAfterHref = trim($attributesAfterHref);

		if ($attributesBeforeHref != '') {
			$attributesBeforeHref = str_replace('"', '\\"', $attributesBeforeHref);
			$attributesBeforeHref = $attributesBeforeHref;
		}

		if ($attributesAfterHref != '') {
			$attributesAfterHref = str_replace('"', '\\"', $attributesAfterHref);
			$attributesAfterHref = ' ' . $attributesAfterHref;
		}
	
		$encoded = '';
		$javascriptmethod = rex_addon::get('email_obfuscator')->getConfig('javascriptmethod');
		$nojavascriptmethod = rex_addon::get('email_obfuscator')->getConfig('nojavascriptmethod');
	
		if ($javascriptmethod) {
			// javascript version
			$encoded_mail_tag = str_rot13('<a ' . $attributesBeforeHref . 'href=\\"mailto:' . $email . '\\"' . $attributesAfterHref . '>' . $text . '</a>');
			$encoded = "<script type=\"text/javascript\">";
			$encoded .= "/* <![CDATA[ */";
			$encoded .= "document.write(\"" . $encoded_mail_tag . "\".replace(/[a-zA-Z]/g, function(c){return String.fromCharCode((c<=\"Z\"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));";
			$encoded .= "/* ]]> */";
			$encoded .= "</script>";
		}
	
		// for users who have javascript disabled
		$exploded_email = explode("@", $email);
	
		if ($javascriptmethod && !$nojavascriptmethod) {
			$noscriptMsg = rex_addon::get('email_obfuscator')->getConfig('noscript_msg');

			if ($noscriptMsg != '') {
				$encoded .= '<noscript><em>&gt;&gt;&gt; ' . $noscriptMsg . ' &lt;&lt;&lt;</em></noscript>';
			}
		} else {
			if ($javascriptmethod && $nojavascriptmethod) {
				$encoded .= '<noscript>';
			}

			// make cryptic strings
			$string_snippet = strtolower(str_rot13(preg_replace("/[^a-zA-Z]/", "", $email)));
			$cryptValues = str_split($string_snippet, 5);
		
			if ($nojavascriptmethod) {
				$encoded .= "<span class=\"hide\">" . $cryptValues[0] . "</span>" . $exploded_email[0] . "<span class=\"hide\">" . strrev($cryptValues[0]) . "</span>[at]<span class=\"hide\">" . $cryptValues[0] . "</span>" . $exploded_email[1];
			}
		
			if ($javascriptmethod && $nojavascriptmethod) {
				$encoded .= '</noscript>';
			}
		}
	
		return $encoded;
	}

	// found here: http://zenverse.net/php-function-to-auto-convert-url-into-hyperlink/
	public static function makeEmailClickable($ret) {
		$ret = ' ' . $ret;
		// in testing, using arrays here was found to be faster
		$ret = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', 'rex_email_obfuscator::_make_email_clickable_cb', $ret);
	 
		// this one is not in an array because we need it to run last, for cleanup of accidental links within links
		$ret = preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $ret);
		$ret = trim($ret);

		return $ret;
	}

	protected static function _make_email_clickable_cb($matches) {
		$email = $matches[2] . '@' . $matches[3];

		return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
	}
}
