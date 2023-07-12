<section>
    <div class="m-3 p-2">
        <x-molecules.breadcrumb :paths="$paths" />
    </div>
    <div class="m-3">
        <x-molecules.alert-status :status="session(config('define.session.status'), [])" />
    </div>
</section>
