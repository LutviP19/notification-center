require('./bootstrap');
require('./laravel-echo-setup');
require('./main-notify');

import Alpine from 'alpinejs';
import {Buffer} from 'buffer/';

window.Alpine = Alpine;

Alpine.start();

global.Buffer = Buffer;
//import crypto from 'crypto-browserify';
//window.crypto = crypto;


//const crypto = require('crypto-browserify');
var crypto = require('crypto');

let key = process.env.MIX_OPENSSL_SECRET_KEY;
var iv = process.env.MIX_OPENSSL_SECRET_IV;

let text = '0812-8888-9999';

function encrypt_token(data) {
    let cipher = crypto.createCipheriv('aes-256-cbc', key, iv);
    cipher.update(data, 'binary', 'base64');
    return cipher.final('base64');
}

function decrypt_token(data) {
    let decipher = crypto.createDecipheriv('aes-256-cbc', key, iv);
    decipher.update(data, 'base64', 'binary');
    return decipher.final('binary');
}

console.log('NodeJS encrypt: ', encrypt_token(text));
console.log('NodeJS decrypt: ', decrypt_token('yHsFnmWk+I3AV2F2ZAQGqA==')); //'dmyz.org'
