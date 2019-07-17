<?php

if (!rex::isBackend()) {
	rex_extension::register('OUTPUT_FILTER', array('rex_email_obfuscator', 'obfuscate'), rex_extension::LATE);
}
