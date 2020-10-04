# Compile all .po files to .mo files in locales directory
cd ../app/locales
for lang_locale in * ; do
    if [ ! -f "$lang_locale/LC_MESSAGES/$lang_locale.po" ]; then
        continue
    fi
    cd "$lang_locale/LC_MESSAGES"
    /usr/bin/msgfmt "$lang_locale.po" -f -o "$lang_locale.mo"
    echo "$lang_locale - compiled"
    cd ../../
done
