        </div>
        <!-- end main content-->
    </div>
 <?php include('modal_content.php'); ?>

<!-- END layout-wrapper -->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="bi bi-arrow-up-circle-fill"></i>
</button>
<script src="js/popper.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/simplebar.min.js"></script>
<script src="js/waves.min.js"></script>
<script src="js/feather.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/swiper-bundle.min.js"></script>
<script src="js/dashboard-ecommerce.init.js"></script>
<script src="js/chart.umd.js"></script>
<script src="js/chartjs.init.js"></script>
<script src="js/app.js"></script>
<script src="js/fonticons.js"></script>
<script src="include/select2/js/select2.min.js"></script>
<script src="include/select2/js/select.js"></script>
<script src="include/js/common.js"></script>
<script src="include/js/keyboard_control.js"></script>
<script>
    $(document).on('select2:open', function() {
        setTimeout(() => {
            let searchField = document.querySelector('.select2-container--open .select2-search__field');
            if (searchField) {
                searchField.focus();
            }
        }, 0);
    });
</script>
</body>
</html>
