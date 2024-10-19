<form action="#" method="get">
    <input type="text" id="input_field" placeholder="Enter a number">

    <label for="check" id="checkbox_label" style="display: none;">Check this box</label>
    <input type="checkbox" name="check" id="check" style="display: none;">

    <button type="button" onclick="assignValue()">Submit</button>

    <script>
        function assignValue() {
            let inputValue = document.getElementById("input_field").value;
            let checkbox = document.getElementById("check");
            let checkboxLabel = document.getElementById("checkbox_label");

            // Convert input value to integer and check if it's greater than 0
            if (parseInt(inputValue) > 0) {
                checkbox.style.display = "inline-block";  // Show checkbox
                checkboxLabel.style.display = "inline-block";  // Show label
            } else {
                checkbox.style.display = "none";  // Hide checkbox
                checkboxLabel.style.display = "none";  // Hide label
            }
        }
    </script>
</form>
