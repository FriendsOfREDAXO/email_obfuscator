<?php

$content = '';
$buttons = '';

// Einstellungen speichern
if (rex_post('formsubmit', 'string') == '1') {
    $this->setConfig(rex_post('config', [
        ['javascriptmethod', 'int'],
        ['nojavascriptmethod', 'int'],
        ['noscript_msg', 'string'],
		['articles', 'string'],
		['templates', 'array[int]']
    ]));

    echo rex_view::success($this->i18n('config_saved'));
}

// js metjod
$formElements = [];
$n = [];
$n['label'] = '<label for="javascriptmethod">' . $this->i18n('config_javascriptmethod') . '</label>';
$n['field'] = '<input type="checkbox" id="javascriptmethod" name="config[javascriptmethod]"' . ($this->getConfig('javascriptmethod') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');

// no js method
$formElements = [];
$n = [];
$n['label'] = '<label for="nojavascriptmethod">' . $this->i18n('config_nojavascriptmethod') . '</label>';
$n['field'] = '<input type="checkbox" id="nojavascriptmethod" name="config[nojavascriptmethod]"' . ($this->getConfig('nojavascriptmethod') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');

// js msg
$formElements = [];
$n = [];
$n['label'] = '<label for="noscript_msg">' . $this->i18n('config_noscript_msg') . '</label>';
$n['field'] = '<input class="form-control" type="text" id="noscript_msg" name="config[noscript_msg]" value="' . $this->getConfig('noscript_msg') . '"/>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');


// whitelist stuff
$formElements = [];
$n = [];
$n['label'] = '<label for="email_obfuscator-config-articles">' . $this->i18n('config_articles') . '</label>';
$n['field'] = rex_var_linklist::getWidget(1, 'config[articles]', $this->getConfig('articles'));
$formElements[] = $n;

$n = [];
$n['label'] = '<label for="email_obfuscator-config-templates">' . $this->i18n('config_templates') . '</label>';
$select = new rex_select();
$select->setId('email_obfuscator-config-templates');
$select->setMultiple();
$select->setSize(10);
$select->setAttribute('class', 'form-control');
$select->setName('config[templates][]');
$select->addSqlOptions('SELECT `name`, `id` FROM `' . rex::getTablePrefix() . 'template` ORDER BY `name` ASC');
$select->setSelected($this->getConfig('templates'));
$n['field'] = $select->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');


// Save-Button
$formElements = [];
$n = [];
$n['field'] = '<button class="btn btn-save rex-form-aligned" type="submit" name="save" value="' . $this->i18n('config_save') . '">' . $this->i18n('config_save') . '</button>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$buttons = $fragment->parse('core/form/submit.php');
$buttons = '
<fieldset class="rex-form-action">
    ' . $buttons . '
</fieldset>
';

// Ausgabe Formular
$fragment = new rex_fragment();
$fragment->setVar('class', 'edit');
$fragment->setVar('title', $this->i18n('config'));
$fragment->setVar('body', $content, false);
$fragment->setVar('buttons', $buttons, false);
$output = $fragment->parse('core/page/section.php');

$output = '
<form action="' . rex_url::currentBackendPage() . '" method="post">
<input type="hidden" name="formsubmit" value="1" />
    ' . $output . '
</form>
';

echo $output;

?>

