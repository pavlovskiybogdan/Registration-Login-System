# Find all new words that .po files not includes
echo "Parsing..."
LIST=`find . -name "*.php"`
/usr/bin/xgettext --language=PHP $LIST --from-code=UTF-8 --no-location --no-wrap -o /tmp/xgettext.pot

echo "Merging..."
cd ../app/locales

for lang_locale in * ; do
    if [ ! -f "$lang_locale/LC_MESSAGES/$lang_locale.po" ]; then
        continue
    fi
    echo $lang_locale
    cd "$lang_locale/LC_MESSAGES"
    msgmerge "$lang_locale.po" /tmp/xgettext.pot -U --backup=off --no-wrap --no-fuzzy-matching
    cd ../../
done