<div>
    <h1>Data Count : <strong id="counter"></strong></h1>
    <p>You need <strong id="rest"></strong> for reaching 30.000 data</p>
</div>

<table border="1">
</table>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function getData() {
        $.ajax({
            type: "GET",
            url: "/api/students",
            dataType: "JSON",
            success: function (response) {
                $('#counter').html(response);
                $('#rest').html(parseInt(30000 - response));
                // $('#counter').html(response.length);
                // $('#rest').html(parseInt(30000 - response.length));

                //  data = ``;
                //  response.forEach(element => {
                //     data += `
                //         <tr>
                //             <td>${element.id}</td>
                //             <td>${element.nama}</td>
                //             <td>${element.id_kelas}</td>
                //             <td>${element.password}</td>
                //         </tr>
                //     `
                //  });
                //  $('table').html(data);
            }
        });
    }

    getData();
    setInterval(() => {
        getData();
    }, 10000);
</script>
