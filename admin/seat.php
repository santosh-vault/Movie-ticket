<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        .seat-map {
            display: grid;
            grid-template-columns: repeat(8, 40px);
            gap: 5px;
        }

        .seat {
            width: 40px;
            height: 40px;
            background-color: #bdc3c7;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        .seat.selected {
            background-color: #3498db;
            color: #fff;
        }

        .seat:not(.occupied):hover {
            background-color: #95a5a6;
        }

        .seat.occupied {
            background-color: #ecf0f1;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

    <div class="seat-map">
        <!-- Example: 8 rows and 8 columns of seats -->
        <!-- You can generate this dynamically based on the actual layout of your film hall -->
        <!-- For simplicity, using a loop to create seats -->

        <!-- Rows -->
        <!-- You can customize the number of rows and columns based on your film hall layout -->
        <!-- For example, you might have more rows and columns in an actual film hall -->

        <!-- In a real-world scenario, you might want to fetch the seat data from a database -->
        <!-- and dynamically generate the seat map based on the available seats -->

        <!-- This is a simplified example -->
        <?php
        $totalRows = 8;
        $totalColumns = 8;

        for ($row = 1; $row <= $totalRows; $row++) {
            echo '<div class="seat-row">';
            for ($column = 1; $column <= $totalColumns; $column++) {
                echo '<div class="seat" data-row="' . $row . '" data-column="' . $column . '">
                        ' . $row . '-' . $column . '
                      </div>';
            }
            echo '</div>';
        }
        ?>
    </div>

    <script>
        // JavaScript can be added here to handle seat selection and interaction
        document.addEventListener('DOMContentLoaded', function () {
            const seats = document.querySelectorAll('.seat');

            seats.forEach(seat => {
                seat.addEventListener('click', function () {
                    if (!seat.classList.contains('occupied')) {
                        seat.classList.toggle('selected');
                    }
                });
            });
        });
    </script>

</body>
</html>
