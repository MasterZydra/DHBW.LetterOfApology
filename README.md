# DHBW.LetterOfApology
Projekt aus dem Fach Web Engineering II

## Admin-Portal funktioniert nicht
Gegebenenfalls muss der Parameter `AuthUserFile` in der Datei `src/admin/.htaccess` folgender Pfad angepasst werden:
```
[...]
AuthUserFile \absoluter\pfad\zur\.htpasswd
[...]
```

## Admin-Passwort ändern
Das Standardpasswort und der Standardbenutzer sind:
```
Benutzer: admin
Passwort: Sicher2019%
```
Um das Admin-Passwort zu ändern, muss folgendes in die Windows Konsole eingegeben werden:
```
C:\xampp\apache\bin>htpasswd.exe -c C:\xampp\htdocs\DHBW.LetterOfApology\.htpasswd admin
```