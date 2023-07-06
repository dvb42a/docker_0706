
// 暫時用假裝的 URL 代替, 之後應該用 nowUrl
// let url = 'http://127.0.0.1/root/beauty/content/76/edit';

// 網址處理過程

var nowUrl = window.location.href;
let setUrl = nowUrl.substring(nowUrl.lastIndexOf('/') - 1);
let id = setUrl.substring(setUrl.lastIndexOf('/') + 1);
console.log('nowUrl:', nowUrl, 'id:', id);

// API 位置
let urlApi = link + `/api/media/${id}`;
console.log(urlApi);

// 原先關鍵字紀錄 API
//const objectDataUrl = 'https://raw.githubusercontent.com/dvb42a/API_RAWkinglyproject/main/contentWithTag.json';

// on Load
// 這個 ObjectDataUrl 之後要替換
databaseApi(urlApi); // 獲取 關鍵字資料庫
