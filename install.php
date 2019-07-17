<?php

// set default config values
if (!$this->hasConfig('javascriptmethod')) {
    $this->setConfig('javascriptmethod', 1);
}

if (!$this->hasConfig('nojavascriptmethod')) {
    $this->setConfig('nojavascriptmethod', 0);
}

if (!$this->hasConfig('noscript_msg')) {
    $this->setConfig('noscript_msg', 'Bitte JavaScript aktivieren um die Email-Adresse sichtbar zu machen! / Please activate JavaScript to see email address!');
}

if (!$this->hasConfig('articles')) {
    $this->setConfig('articles');
}

if (!$this->hasConfig('templates')) {
    $this->setConfig('templates');
}
