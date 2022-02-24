window._ = require('lodash');

/**
 *  Encryptions
 */
var key = process.env.MIX_OPENSSL_SECRET_KEY;
var iv = process.env.MIX_OPENSSL_SECRET_IV;
var CryptoJS = require("crypto-js");

function encrypt_data(data) {
    let encrypted = CryptoJS.AES.encrypt(CryptoJS.enc.Utf8.parse(data), CryptoJS.enc.Hex.parse(key), { iv: CryptoJS.enc.Hex.parse(iv) });

    return encrypted.ciphertext.toString();
}

function decrypt_data(data) {
    cipherParams = CryptoJS.lib.CipherParams.create({ ciphertext: CryptoJS.enc.Hex.parse(data) });
    let decrypted = CryptoJS.AES.decrypt(cipherParams, CryptoJS.enc.Hex.parse(key), { iv: CryptoJS.enc.Hex.parse(iv) });

    return decrypted.toString(CryptoJS.enc.Utf8);
}

encrypt_data.exports = function encrypt_data(data) {
    return encrypt_data(data);
}
decrypt_data.exports = function decrypt_data(data) {
    return decrypt_data(data);
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

//window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    'X-Requested-With': 'XMLHttpRequest',
    'Accept': 'application/json',
    'Authorization': 'Bearer ' + localStorage.getItem('jwt')
};
//window.axios.defaults.withCredentials = true;

// set Request
// Add a request interceptor
window.axios.interceptors.request.use(function (config) {
    //console.log(config.data.phone_number)
    if(config.data.phone_number) {
        config.data.phone_number = encrypt_data(config.data.phone_number)
    }

    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

// Add a response interceptor
window.axios.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    //console.log(response.data.phone_number !== 'undefined')
    if(response.data.phone_number) {
        if(response.data.phone_number !== null) {
            response.data.phone_number = decrypt_data(response.data.phone_number)
        }
        if(response.data.user_id !== null) {
            //response.data.user_id = decrypt_data(response.data.user_id)
            //response.data.user_id = encrypt_data(response.data.user_id)
        }
    } else {
        const reformattedArray = response.data.map(item => {
            var temp = Object.assign({}, item);
            if (temp.phone_number !== null) {
                temp.phone_number = decrypt_data(temp.phone_number);
            }
            if (temp.user_id !== null) {
                //temp.user_id = decrypt_data(temp.user_id);
                //temp.user_id = encrypt_data(temp.user_id);
            }

            return temp;
        });

        //console.log(reformattedArray)
        return reformattedArray;
    }

    return response;
}, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    return Promise.reject(error);
});


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

/*
window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
    enabledTransports: ['ws', 'wss']
});
*/

