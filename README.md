Email Obfuscator AddOn für REDAXO 5
===================================

Durch dieses Addon werden alle Email-Adressen automatisch so verschleiert, dass sie von Spambots nicht mehr erkannt werden können. Dabei ist es egal ob die Email-Adressen sich in einem Template oder einem Block/Modul befinden.

Email-Adressen können mit oder ohne Anchor-Tag angegeben werden. Die folgenden Bespiele sind also möglich:

* `foo@gmx.de`
* `<a href="mailto:foo@gmx.de">Foo's EMail Adresse>`

Um die Email-Adressen zu schützen, werden die Techniken "CSS display:none" und "ROT13 Encryption" angewendet. Diese können weiter unten ein- oder ausgeschaltet werden. Weitere Informationen zu den Techniken in diesem Artikel: [Nine ways to obfuscate e-mail addresses compared](http://techblog.tilllate.com/2008/07/20/ten-methods-to-obfuscate-e-mail-addresses-compared)

__Wichtiger Hinweis:__ die CSS Display None Methode benötigt diesen Style: `span.hide { display: none; }`

Features
--------

* Vollautomatisches Verschleiern der Email-Adressen mit bewährten Algorithmen
* Sowohl nackte als auch Email-Adressen in einem A-Tag werden berücksichtigt
* Mehrere Verschleierungs-Methoden zur Auswahl

Hinweise
--------

* Getestet mit REDAXO 5.2
* Addon-Ordner lautet: `email_obfuscator`
* Die CSS Methode benötigt diesen Eintrag in Ihrem Stylesheet: `span.hide { display: none; }`

Changelog
---------

siehe CHANGELOG.md

Lizenz
------

MIT, siehe LICENSE.md

Credits
-------

* Danke an WordPress für die `make_clickable()` Funktion :)
* Danke an [Xong](https://github.com/xong) für die Hilfe zu RegEx
