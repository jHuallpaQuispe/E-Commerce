<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <link rel="stylesheet" type="text/css" href="estilos/estilos_admin.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
</head>
<body class="body-principal">
    <header class="header">
        <a href="indexadmin.html">
            <img src="imagenes/asd.png" alt="Logo de la página" class="logo">
        </a>
    </header>
    <main>
        <div class="table-container">
            <?php
                include 'conexion.php';

                $consulta = mysqli_query($conexion, "SELECT * FROM usuario");

                if (mysqli_num_rows($consulta) > 0) {
                    echo '<table class="styled-table">';
                    echo '<thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Acciones</th></tr></thead>';
                    echo '<tbody>';
                    while ($resultado = mysqli_fetch_array($consulta)) {
                        echo '<tr>';
                        echo '<td>' . $resultado["ID"] . '</td>';
                        echo '<td>' . $resultado["Nombre"] . '</td>';
                        echo '<td>' . $resultado["Apellido"] . '</td>';
                        echo '<td>' . $resultado["Email"] . '</td>';
                        echo '<td><button class="edit-button" onclick="openEditModal(' . $resultado["ID"] . ', \'' . $resultado["Nombre"] . '\', \'' . $resultado["Apellido"] . '\', \'' . $resultado["Email"] . '\')">Editar</button></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No hay datos disponibles.</p>';
                }

                mysqli_close($conexion);
            ?>

            <button class="add-button" onclick="openAddModal()">+</button>
        </div>

        <!-- Modal Editar -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('editModal')">&times;</span>
                <form action="actualizar_usuario.php" method="POST" class="edit-form">
                    <input type="hidden" id="edit-id" name="ID">
                    <label for="edit-nombre">Nombre:</label>
                    <input type="text" id="edit-nombre" name="Nombre"><br>
                    <label for="edit-apellido">Apellido:</label>
                    <input type="text" id="edit-apellido" name="Apellido"><br>
                    <label for="edit-email">Email:</label>
                    <input type="email" id="edit-email" name="Email"><br>
                    <input type="submit" value="Actualizar" class="edit-submit">
                </form>
            </div>
        </div>

        <!-- Modal Agregar -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addModal')">&times;</span>
                <form action="agregar_usuario.php" method="POST" class="edit-form">
                    <label for="add-nombre">Nombre:</label>
                    <input type="text" id="add-nombre" name="Nombre"><br>
                    <label for="add-apellido">Apellido:</label>
                    <input type="text" id="add-apellido" name="Apellido"><br>
                    <label for="add-email">Email:</label>
                    <input type="email" id="add-email" name="Email"><br>
                    <label for="add-email">Admin:</label>
                    <input type="email" id="add-email" name="Admin"><br>
                    <input type="submit" value="Agregar" class="edit-submit">
                </form>
            </div>
        </div>

        <script>
            function openEditModal(id, nombre, apellido, email) {
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-nombre').value = nombre;
                document.getElementById('edit-apellido').value = apellido;
                document.getElementById('edit-email').value = email;
                document.getElementById('editModal').style.display = "block";
            }

            function openAddModal() {
                document.getElementById('addModal').style.display = "block";
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = "none";
            }

            window.onclick = function(event) {
                const editModal = document.getElementById('editModal');
                const addModal = document.getElementById('addModal');
                if (event.target == editModal) {
                    closeModal('editModal');
                } else if (event.target == addModal) {
                    closeModal('addModal');
                }
            }
        </script>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Mi Página. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
