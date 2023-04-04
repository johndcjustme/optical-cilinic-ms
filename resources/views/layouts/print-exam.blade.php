<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    :root {
        --border-black: 1px solid black;
        --border-gray: 1px solid lightgray;
        --border-cut: 1px solid lightgray;
    }
    html {
        font-size: 0.85rem;
        font-family: Arial, Helvetica, sans-serif;
    }
    table.refraction, table.claim-stub {
        border-collapse: collapse;
        width: 100%;
        /* font-size: 0.85rem; */
    }
    table.refraction, table.refraction th, table.refraction td {
        border: var(--border-black);
        padding: 5px;
    }
    table.claim-stub td {
        padding: 5px;
    }
    .border {
        border: var(--border-black);
    }
    .border-r {
        border-right: var(--border-black);
    }
    .border-t {
        border-top: var(--border-black)
    }
    .border-b {
        border-bottom: var(--border-black);
    }
    .border-r-gray {
        border-right: var(--border-gray);
    }
    .border-t-gray {
        border-top: var(--border-gray)
    }
    .border-b-gray {
        border-bottom: var(--border-gray);
    }
    .cut {
        border-bottom: var(--border-cut);
    }
    @media print {
        .noPrint{
            display:none;
        }
    }
</style>
<body>
    
    @yield('content')




    <script>
        function myFunction() {
            var checkBox = document.getElementById("myCheck");
            var refractionFor = document.getElementById("refraction-for");
            var important = document.getElementById("important");

            if (checkBox.checked == true){
                refractionFor.innerHTML = "ORDER";
                important.style.display = "block";
            } else {
                refractionFor.innerHTML = "LABORATORY";
                important.style.display = "none";

            }
        }
    </script>

    <script>

        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

    </script>
</body>
</html>