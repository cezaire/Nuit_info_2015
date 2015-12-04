<form class="form-horizontal" action="../Model/alert.php">
    <fieldset>

        <!-- Form Name -->
        <legend>NEW ALERT</legend>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="selectbasic">TYPES</label>
            <div class="col-md-4">
                <select id="selectbasic" name="selectbasic" class="form-control">
                    <option value="1" selected>Attentat</option>
                    <option value="2">Épidémie</option>
                </select>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-default">Alerter</button>
            </div>
        </div>

    </fieldset>
</form>