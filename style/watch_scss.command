#!/bin/sh
#per rendere questo file cliccabile aprire un terminale nella cartella che lo contiene e dare il comando "chmod a+x watch_scss.command"

# nei file .command la cartella in cui viene aperto il terminale e' la home; questo ci sposta nella cartella del file stesso.
cd -- "$(dirname "$BASH_SOURCE")"

sass --sourcemap=none --watch scss/style.scss:css/style.css
# CONTROLLARE SE --sourcemap=none FA QUELLO CHE DEVE