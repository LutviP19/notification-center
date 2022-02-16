
/* var key = '59b6ab46d379b89d794c87b74a511fbd59b6ab46d379b89d794c87b74a511fbd';
var iv = '0aaff094b6dc29742cc98a4bac8bc8f9'; */

console.log(window.key);

var key = window.key;
var iv = window.iv;

/* Original Source
var data = "0812-8888-7777";
var encrypted = CryptoJS.AES.encrypt(CryptoJS.enc.Utf8.parse(data), CryptoJS.enc.Hex.parse(key), { iv: CryptoJS.enc.Hex.parse(iv) });

console.log( 'Ciphertext: [' + encrypted.ciphertext + ']' );
console.log( 'Key:        [' + encrypted.key + ']' );

cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Hex.parse(encrypted.ciphertext.toString())});
var decrypted = CryptoJS.AES.decrypt(cipherParams, CryptoJS.enc.Hex.parse(key), { iv: CryptoJS.enc.Hex.parse(iv) });

console.log( 'Cleartext:  [' + decrypted.toString(CryptoJS.enc.Utf8) + ']');

function test(){
    alert('test')
}
 */

function encrypt_data(data) {
    let encrypted = CryptoJS.AES.encrypt(CryptoJS.enc.Utf8.parse(data), CryptoJS.enc.Hex.parse(key), { iv: CryptoJS.enc.Hex.parse(iv) });

    return encrypted.ciphertext.toString();
}

function decrypt_data(data) {
    cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Hex.parse(data)});
    let decrypted = CryptoJS.AES.decrypt(cipherParams, CryptoJS.enc.Hex.parse(key), { iv: CryptoJS.enc.Hex.parse(iv) });

    return decrypted.toString(CryptoJS.enc.Utf8);
}

/* Testing
let text = '0812-8888-7777';
console.log('NodeJS encrypt: ', encrypt_data(text));
console.log('NodeJS decrypt: ', decrypt_data('9ba306dd9c2931c3b45da67ac0c68f5d'));
*/
