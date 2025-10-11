<?php
// a small template part. Save as template-parts/property-search-form.php
?>
<form method="get" action="<?php echo esc_url(get_post_type_archive_link('property') ? get_post_type_archive_link('property') : home_url('/')); ?>">
<div class="mb-2">
<label class="form-label small">Keyword</label>
<input name="s" value="<?php echo esc_attr($_GET['s'] ?? ''); ?>" class="form-control" placeholder="Search by title or description">
</div>
<div class="row g-2">
<div class="col-6">
<label class="form-label small">Min price</label>
<input name="min_price" value="<?php echo esc_attr($_GET['min_price'] ?? ''); ?>" class="form-control" type="number" step="1">
</div>
<div class="col-6">
<label class="form-label small">Max price</label>
<input name="max_price" value="<?php echo esc_attr($_GET['max_price'] ?? ''); ?>" class="form-control" type="number" step="1">
</div>
</div>
<div class="row g-2 mt-2">
<div class="col-6">
<label class="form-label small">Bedrooms</label>
<select name="bedrooms" class="form-select">
<option value="">Any</option>
<option value="1">1+</option>
<option value="2">2+</option>
<option value="3">3+</option>
<option value="4">4+</option>
</select>
</div>
<div class="col-6">
<label class="form-label small">Type</label>
<select name="property_type" class="form-select">
<option value="">Any</option>
<option value="apartment">Apartment</option>
<option value="house">House</option>
<option value="studio">Studio</option>
</select>
</div>
</div>
<div class="d-grid gap-2 mt-3">
<button class="btn btn-primary">Sea