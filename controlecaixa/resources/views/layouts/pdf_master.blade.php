<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('titulo', 'PowerTrade.Py')</title>

        <!-- Bootstrap Css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                /* padding: 8px; */
                /* text-align: left; */
                border-right: 1px solid #000; /* Adiciona borda à direita de cada célula */
                border-left: 1px solid #000; /* Adiciona borda à esquerda de cada célula */
                border-bottom: none;
            }

            th {
                /* background-color: #f2f2f2; */
                border-top: 1px solid #000; /* Adiciona borda superior às células do cabeçalho */
                border-bottom: 1px solid #000; /* Adiciona borda inferior às células do cabeçalho */
            }

            tr:last-child td {
                border-bottom: 1px solid #000; /* Adiciona borda inferior às células da última linha */
            }

            /* td:last-child {
                border-right: none; /* Remove a borda à direita da última célula de cada linha */
            } */
        </style>
    </head>

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                @yield('view')

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>

</html>
