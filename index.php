<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        thead > tr {
            /*border:  1px solid;*/
            background: aqua;
        }

        th, td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #D6EEEE;
        }
    </style>
</head>
<body>

<h2>Zebra Striped Table</h2>
<p>For zebra-striped tables, use the nth-child() selector and add a background-color to all even (or odd) table
    rows:</p>

<div id="tableDiv" style="height: 50vh;overflow-y: scroll">
    <table>
        <thead style="position:sticky;top: 0">
        <tr>
            <th>title</th>
            <th>slug</th>
            <th>body</th>
            <th>name</th>
            <th>email</th>
            <th>published_at</th>
        </tr>
        </thead>
        <tbody id="mainTbody">

        </tbody>
    </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
<script>
    const div = document.querySelector("#tableDiv");
    div.addEventListener("scroll", () => {
        // if (div.scrollTop + div.clientHeight >= div.scrollHeight) loadMore();
    });
    loadMore();
    function loadMore() {
        $.ajax({
            url:'Db.php',
            method:'GET',
            success:function (obj) {
                const data = JSON.parse(obj);
                $.each(data.data,function (i,row) {
                    let tr = `<tr>`;
                    tr+= `<td>${row.title}</td>`
                    tr+= `<td>${row.slug}</td>`
                    tr+= `<td>${row.body}</td>`
                    tr+= `<td>${row.name}</td>`
                    tr+= `<td>${row.email}</td>`
                    tr+= `<td>${row.published_at}</td>`
                    tr += `</tr>`;
                    $('#mainTbody').append(tr);
                })


            }
        })
    }
</script>
