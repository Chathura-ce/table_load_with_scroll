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

<h2>LOAD DATA WHILE SCROLLING TABLE</h2>
<div style="display: flex;justify-content: flex-end">
    <img onclick="exportExcel()" src="excel.png" alt="" style="cursor:pointer;">
</div>
<div id="tableDiv" style="height: 50vh;overflow-y: scroll">
    <table border="1">
        <thead style="position:sticky;top: 0">
        <tr>
            <th>id</th>
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
    // let LAST_PAGE = null;
    let PAGE = 1;
    let LOADED = false;
    const div = document.querySelector("#tableDiv");
    div.addEventListener("scroll", () => {
        if (div.scrollTop + div.clientHeight >= div.scrollHeight) loadMore();
    });
    loadMore();

    function loadMore() {
        if (LOADED) return;
        $.ajax({
            url: 'Db.php',
            method: 'GET',
            data: {
                p: PAGE
            },
            success: function (obj) {
                const data = JSON.parse(obj);
                setData(data);
                $.each(data.data, function (i, row) {
                    let tr = `<tr>`;
                    tr += `<td>${row.id}</td>`
                    tr += `<td>${row.title}</td>`
                    tr += `<td>${row.slug}</td>`
                    tr += `<td>${row.body}</td>`
                    tr += `<td>${row.name}</td>`
                    tr += `<td>${row.email}</td>`
                    tr += `<td>${row.published_at}</td>`
                    tr += `</tr>`;
                    $('#mainTbody').append(tr);
                })


            }
        })
    }

    function setData(data) {
        if (PAGE >= data.last_page) {
            LOADED = true;
            return;
        }
        PAGE = parseInt(data.p) + 1;
    }

    function exportExcel() {
        window.open('excelExport.php');
    }
</script>

