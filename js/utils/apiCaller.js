//import * as Config from '../constants/configs.js';
export default function httpGetAsync(method, myUrl, resolve, reject, pending = null,databody=null) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status === 200||xmlHttp.readyState == 4 && xmlHttp.status === 201) {
            resolve(xmlHttp);
        }
        if (xmlHttp.readyState == 2 || xmlHttp.readyState == 3) {
            if (pending !== null) {
                pending();
            }
        }
        if (xmlHttp.readyState == 4 && xmlHttp.status != 200) {
            reject();
        }
    };
    xmlHttp.open(method, myUrl, true);
    xmlHttp.send(databody);
}

