# README

Lade dir das Repository in dein gewünschtes Zielverzeichnis.
Über das Termin Terminal:
git clone https://github.com/Blitzi34/login.git
Alternativ als Zip-Datei und im Zielverzeichnis entpacken. 

Falls nicht vorhanden, lade dir Docker-Desktop für Windows oder Mac runter und starte die Anwendung.
https://docs.docker.com/guides/getting-started/get-docker-desktop/#explanation

Für Linux folge siehe hier:
https://docs.docker.com/desktop/install/linux-install/#generic-installation-steps

Wechsel mit dem Terminal in das Verzeichnis:
cd login

Prüfe im Termin mit "ls", ob doe docker-compse.yml vorhanden ist und für diese aus:
docker compose up -d

Besuche in deinem Browser die Seite "http://localhost" (Port 80). 
Für phpMyAdmin besuche http://localhost:8001/ (Port 8001).
Der Benutzername und Passwort sind "login". 