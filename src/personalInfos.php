<div class="input-group">
    <h4 class="input-group-caption">Persönliche Informationen</h4>
    <div class="row">
        <div class="col-2 input-field">
            <label for="firstname">Vorname:</label>
            <input type="text"
                   id="firstname" name="firstname"
                   placeholder="Vorname" required autofocus>
        </div>
        <div class="col-2 input-field">
            <label for="lastname">Nachname:</label>
            <input type="text"
                   id="lastname" name="lastname"
                   placeholder="Nachname" required>
        </div>
    </div>

    <div class="address">
        <label for="street">Straße:</label><br>
        <input type="text"
               id="street" name="street"
               placeholder="Straße und Hausnummer" required><br>

        <div class="row">
            <div class="col-2 input-field">
                <label for="postalCode">PLZ:</label>
                <input type="text"
                       id="postalCode" name="postalCode"
                       placeholder="PLZ" required>
            </div>

            <div class="col-2 input-field">
                <label for="city">Stadt:</label>
                <input type="text"
                       id="city" name="city"
                       placeholder="Stadt" required>
            </div>
        </div>
    </div>
</div>