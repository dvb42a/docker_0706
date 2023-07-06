<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <title> Keyword Tag </title>
    </head>

    <body class="container">
        @livewireStyles
        @livewire('test-table')
        <button type="button" id="API_submit">API</button>
    </body>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
    <script>
/*         let csrfToken = document.head.querySelector('meta[name="csrf-token"]');
        document.getElementById('AP_submit').addEventListener('change',(e)=>{
            fetch('htt://127.0.0.1/api/chapter',{
                method : 'POST',
                body: JSON.stringify({text : e.target.value}),
                headers:{
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken.content
                }
            }).then(response =>{
                return response.json()
            }).then( data =>{


            }).catch(error =>console.error(error));
        }) */
        let ky_array =
        [
        "1",
        "2",
        "3",
        "4",
        "5"
        ];
        var url = link+'/api/chapter';

        var data = ky_array;

        document.getElementById('API_submit').addEventListener('click',()=>{
            fetch(url, {
            method: 'POST', // or 'PUT'
            body: JSON.stringify({
                ky_array1: ky_array,
            }), // data can be `string` or {object}!
            headers: new Headers({
                'Content-Type': 'application/json'
            })
            }).then(res => res.json())
            .catch(error => console.error('Error:', error))
            .then( () => {
                console.log('true');
                window.location.reload();

        });
            //console.log(data);
        });
    </script>
</html>





