<?php
/**
 * Componente de footer reutilizable
 * Uso: include 'components/footer.php';
 */
?>

  <!-- Scripts -->
  <script src="../js/toast.js"></script>
  <script src="../js/theme-toggle.js"></script>
  <script src="../js/file-uploader.js"></script>
  <script>
    // Funciones globales auxiliares
    document.addEventListener('DOMContentLoaded', function() {
      // Auto-cerrar mensajes después de mostrarlos
      const urlParams = new URLSearchParams(window.location.search);
      const message = urlParams.get('message');
      const type = urlParams.get('type');
      
      if (message && type) {
        toast[type](decodeURIComponent(message));
        // Limpiar URL
        window.history.replaceState({}, document.title, window.location.pathname);
      }
    });
  </script>

</body>
</html>
<?php
// Fin del documento HTML
?>