<?php
include "./DB.php"; // Assicurati di includere il file contenente la classe Database

function displayTableFromDatabase($tableName, $columns) {
    Database::connect(); // Connessione al database

    // Verifica se la tabella è stata fornita correttamente
    if (!empty($tableName)) {
        // Verifica se le colonne sono state fornite
        if (isset($columns) && !empty($columns)) {
            $columnsArray = explode(',', $columns); // Converti la stringa delle colonne in un array
            $selectColumns = implode(',', $columnsArray); // Genera elenco di colonne da selezionare
        } else {
            $selectColumns = '*'; // Se le colonne non sono specificate, seleziona tutte le colonne
        }

        $query = "SELECT $selectColumns FROM `$tableName`"; // Costruzione della query SQL

        $ris = Database::executeQuery($query); // Esecuzione della query

        if ($ris) {
            ?>

            <table border="4">
                <tr>
                    <?php
                    // Ottieni l'elenco di colonne per l'intestazione della tabella
                    $columnsForHeader = ($selectColumns == '*') ? '*' : $columnsArray;
                    
                    // Stampare le intestazioni della tabella
                    if ($columnsForHeader == '*') {
                        echo "<th>*</th>"; // Intestazione generica se si selezionano tutte le colonne
                    } else {
                        foreach ($columnsForHeader as $column) {
                            echo "<th>" . htmlspecialchars($column) . "</th>";
                        }
                    }
                    ?>
                </tr>

                <?php
                // Stampare i dati delle righe della tabella
                while ($row = $ris->fetch_object()) {
                    echo "<tr>";
                    foreach ($columnsArray as $column) {
                        echo "<td>" . htmlspecialchars($row->$column) . "</td>";
                    }
                    echo "</tr>";
                }
                ?>

            </table>

            <?php
        } else {
            echo "Errore durante l'esecuzione della query.";
        }
    } else {
        echo "Nome della tabella non valido.";
    }

    Database::disconnect(); // Chiusura della connessione al database
}
?>
