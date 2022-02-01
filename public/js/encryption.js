//import crypto from '/crypto-browserify'
//import { Buffer } from '/buffer' // <-- no typo here ("/")
/*
const crypto = require('crypto');
const password = process.env.MIX_OPENSSL_SECRET_KEY; // Must be 256 bytes (32 characters)

function encrypt(text) {
    if (process.versions.openssl <= '1.0.1f') {
        throw new Error('OpenSSL Version too old, vulnerability to Heartbleed')
    }

    //let iv = crypto.randomBytes(IV_LENGTH);
    let iv = process.env.MIX_OPENSSL_SECRET_IV;
    let cipher = crypto.createCipheriv('aes-256-cbc', new Buffer(password), iv);
    let encrypted = cipher.update(text);

    encrypted = Buffer.concat([encrypted, cipher.final()]);

    return iv.toString('hex') + ':' + encrypted.toString('hex');
}

function decrypt(text) {
    let textParts = text.split(':');
    let iv = new Buffer(textParts.shift(), 'hex');
    //let iv = new Buffer(process.env.MIX_OPENSSL_SECRET_IV, 'hex');
    let encryptedText = new Buffer(textParts.join(':'), 'hex');
    let decipher = crypto.createDecipheriv('aes-256-cbc', new Buffer($password), iv);
    let decrypted = decipher.update(encryptedText);

    decrypted = Buffer.concat([decrypted, decipher.final()]);

    return decrypted.toString();
}
*/
