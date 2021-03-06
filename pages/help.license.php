<?php
$file = rex_file::get($this->getPath('LICENSE.md'));

$parsedown = new Parsedown();
$content = $parsedown->text($file);

$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('help_license'));
$fragment->setVar('body', $content, false);

echo $fragment->parse('core/page/section.php');
