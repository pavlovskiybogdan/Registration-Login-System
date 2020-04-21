const path = require('path');

module.exports = {
    entry: path.resolve(__dirname, 'app/assets/js/dev/main.js'),
    output: {
        filename: 'app.js',
        path: path.resolve(__dirname, 'app/assets/js/prod/')
    },
};