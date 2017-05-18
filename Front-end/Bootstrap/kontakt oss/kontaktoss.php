<?php require "../header/header.php"?>

<div class="container">
<div class="row">
    <div style="margin-top: 50px;">
    <div class="col-md-6 col-md-offset-3">
    <div class="well well-sm">
        <form class="form-horizontal" action="" method="post">
        <fieldset>
        <legend class="text-center">Kontakt Oss</legend>
    
            <!-- Name input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="navn">Navn</label>
                <div class="col-md-9">
                    <input id="navn" navn="navn" type="text" placeholder="Ditt navn" class="form-control">
                </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="">E-post</label>
                <div class="col-md-9">
                    <input id="e-post" name="e-post" type="text" placeholder="Din e-post" class="form-control">
                </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
                <label class="col-md-3 control-label" for="message">Melding</label>
                <div class="col-md-9">
                    <textarea class="form-control" id="melding" name="melding" placeholder="Vennligst skriv melding her..." rows="5"></textarea>
                </div>
            </div>
    
            <!-- Form actions -->
            <div class="form-group">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                </div>
            </div>
        </fieldset>
        </form>
    </div>
    </div>
    </div>
</div>
</div>

<?php require "../footer/footer.php"?>