Email Obfuscator - Changelog
============================

### Version 2.0.0 - 15. März 2017

* Portierung zu REDAXO 5
* Templates und Artikel können vom Verschlüsseln ausgeschlossen werden
* Attribute in den a-Tags bleiben nun erhalten
* Bei leerer NoScript Message wird die Ausgabe von dem `noscript` Tag unterdrückt

### Version 1.6.0 - 25. Oktober 2014

* Updatefähigkeit für REDAXO 4.6 hergestellt. Einstellungen werden jetzt im Data-Ordner gespeichert.

### Version 1.5.1 - 23. August 2014

* Addon ab 1.5.1 nur noch für REDAXO 4.5+
* Späte OUTPUT_FILTER Registrierung, so dass andere Addons (opf_lang, String Table etc.) vorab Ersetzungen durchführen können, thx@ceekay82

### Version 1.5.0 - 25. Oktober 2013

* Fixed: Email-Adressen wurden innerhalb Input-Tags fälschlicherweise verschleiert
* Fixed: EMail-Adressen mit z.B. `.co.uk` Endung wurden nicht korrekt verschleiert
* Man kann in der `config.inc.php` den Hinweistext ändern, der erscheint wenn JavaScript deaktiviert ist.
* Man kann in der `config.inc.php` für die NoScript Meldung ein Key für das String Table Addon angeben (so mehrsprachiger Hinweistext möglich).

### Version 1.3.0 - 22. September 2013

* Fixed #7: Manche nackten Email-Adressen wurden nicht ersetzt insbesondere wenn diese zwischen einem HTML-Tag standen (z.B. `<p>foo@bar.de</p>`)

### Version 1.2.6 - 26. Mai 2013

* Ersetzung sollte jetzt auch bei einem Title-Attribut in Anchor-Tag sowie bei gleichlautendem Email- und Linktext funktionieren (#1)

### Version 1.2.5 - 13. März 2013

* AddOn Name geändert in `Email Obfuscator`
* License und Changelog hinzugefügt
* CSS Methode standardmäßig abgeschaltet

### Version 1.2.2 - 08. November 2012

* Hinweis für benötigten Style wenn man die CSS Methode nutzt ergänzt
* Unnötige Tags die für die XHTML Validierung nötig waren wurden entfernt

### Version 1.1.0 - 08. Juni 2012

* Der ausgespuckte Code validiert jetzt sauber
* Das Benutzerrecht protect_my_email[] wurde hinzugefügt

### Version 1.0.0 - 07. Dezember 2010


