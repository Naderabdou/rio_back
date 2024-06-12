<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0">
        <span class="float-md-left d-block d-md-inline-block mt-25">
            <span class="d-none d-sm-inline-block">
                {{ __('models.all_rights') }}
                {{ date('Y') }}

                {{ __('models.reserved_to') . ' ' . getSetting('name_website_ar') }}
            </span>
        </span>

        <span class="float-md-right fs-5 d-none d-md-block">
            <a target="_blank" href="https://jaadara.com/">
                {{ __('models.made_with') }}
                <i data-feather="heart"></i>
                {{ __('models.jadara') }}
            </a>
        </span>
    </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->

@include('dashboard.layouts.script')

</body>
<!-- END: Body-->

</html>
