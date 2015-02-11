@include('layouts.right-sidebar')
@include('layouts.headnav-small', array('title' => 'client', 'user' => $user, 'client' => true))
<div class="container-fluid">
    <div id="clients" class="large-12 columns">
        @include('include.client', array('clients' => $clients))
    </div>
</div>
<script type="text/javascript">
    $('.right-slider').rightSlider();
    document.title = 'Rounded - Client';
</script>
