
Echo.channel('process-userdata')
    .listen('.ProcessUserdataEvent', (data) => {
        // this is called when the event notification is received...
        //alert(JSON.stringify(data));
        //console.log('.ProcessUserdataEvent = ' + JSON.stringify(data));

        if(data.userdata) {
            var toast = document.getElementById('toast-default');
            var toastText = document.getElementById('toast-text-default');
            var tableGanjil = document.getElementById("tblGanjil");
            //var tblBodyGanjil = document.getElementById('tblBodyGanjil');
            var tableGenap = document.getElementById("tblGenap");
            //var tblBodyGenap = document.getElementById('tblBodyGgenap');
            var row = data.userdata.number_type == 'ganjil' ? tableGanjil.insertRow(-1) : tableGenap.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            row.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700';
            cell1.className = 'py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white';
            cell2.className = 'py-4 px-6 text-sm font-medium text-right whitespace-nowrap';
            cell1.innerHTML = data.userdata.phone_number;
            cell2.innerHTML = '<a href="#" class="text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:underline">Edit</a> - ' +
                              '<a href="#" class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:underline">Delete</a>';

            toastText.innerHTML = 'Number ' + data.userdata.phone_number + ' successfully saved!';
            toast.style.display = 'block';

            var x = document.getElementById("notifAudio");
            x.play();
        }
    });

Echo.channel('process-auto-userdata')
    .listen('.ProcessAutoUserdataEvent', (data) => {
        // this is called when the event notification is received...
        //alert(JSON.stringify(data));
        console.log('.ProcessAutoUserdataEvent = ' + JSON.stringify(data));
        if(data.data) {
            var toast = document.getElementById('toast-default');
            var toastText = document.getElementById('toast-text-default');
            var tableGanjil = document.getElementById("tblGanjil");
            //var tblBodyGanjil = document.getElementById('tblBodyGanjil');
            var tableGenap = document.getElementById("tblGenap");
            //var tblBodyGenap = document.getElementById('tblBodyGgenap');

            let arr = data.data;
            for (var i = 0; i < arr.length; i++){
                var obj = arr[i];
                //for (var key in obj) {
                    //var value = obj[key];
                    var row = obj['number_type'] == 'ganjil' ? tableGanjil.insertRow(-1) : tableGenap.insertRow(-1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    row.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700';
                    cell1.className = 'py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white';
                    cell2.className = 'py-4 px-6 text-sm font-medium text-right whitespace-nowrap';
                    cell1.innerHTML = obj['phone_number'];
                    cell2.innerHTML = '<a href="#" class="text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:underline">Edit</a> - ' +
                                    '<a href="#" class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:underline">Delete</a>';
                //}
            }

            toastText.innerHTML = '500 Random Number successfully generated!';
            toast.style.display = 'block';
            var x = document.getElementById("notifAudio");
            x.play();
        }
    });

//=== TESTING
Echo.channel('test')
    .listen('.TestEvent', (data) => {
        console.log(data);
    });

Echo.channel('status-liked')
    .listen('.StatusLiked', (data) => {
        console.log(data);
    });

Echo.channel('notification-send')
    .listen('.NotificationEvent', (data) => {
        // this is called when the event notification is received...
        //alert(JSON.stringify(data));
        console.log(data);
    });


//console.log(mainjs.encrypt_datax('aaaaaaa'));