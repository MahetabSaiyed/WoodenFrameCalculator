<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wooden Frame Calculator</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/custom.css">

    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <!-- Calculator Section -->
                <div class="col-lg-6 col-sm-12">

                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                        <h2>Wooden Frame Calculator</h2>

                        <!-- Dropdown for selecting SKUs -->
                        <div class="form-group mb-2" >
                            <label for="selSku">Select SKU:</label>
                            <select name="selSku" id="selSku" class="form-control" >
                                <option value="">-[ No Data ]-</option>
                            </select>
                        </div>

                        <!-- Display Price of per centimeter for Selected Product -->
                        <div class="form-group mb-2" >
                            <label for="txtPrice">Price/cm:</label>
                            <input type="text" name="txtPrice" id="txtPrice" class="form-control" value="" disabled />
                        </div>

                        <!-- Input fields for Width and Height -->
                        <div class="form-group mb-2" >
                            <label for="txtWidth">Width(cm):</label>
                            <input name="txtWidth" id="txtWidth" class="form-control" value="" />
                        </div>

                        <div class="form-group mb-2" >
                            <label for="txtHeight">Height(cm):</label>
                            <input name="txtHeight" id="txtHeight" class="form-control" value="" />
                        </div>

                        <!-- Display Total Perimeter for selected parameters -->
                        <div class="form-group mb-2" >
                            <label for="totPeri">Total Perimeter:</label>
                            <span id="totPeri" class="form-control">0</span>
                        </div>

                        <!-- Display Total Price of One Frame -->
                        <div class="form-group mb-2" >
                            <label for="framePrice">Price of one Frame:</label>
                            <span id="framePrice" class="form-control">0.00</span>
                        </div>

                        <!-- Button for Calculate and Add to Order -->
                        <div class="form-group mb-2" >
                            <button type="button" id="btnCalc" class="btn btn-primary" >Calculate</button>
                            <button type="button" id="btnAddToOrder" class="btn btn-success" >Add to Order</button>
                        </div>

                    </form>

                </div> 

                <!-- Order List Section -->
                <div class="col-lg-6 col-sm-12">
                    <h2>Order List</h2>
                    <table class="table table-bordered table-collapse" id="orderList">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>SKU</th>
                                <th>Qty</th>
                                <th>Width (CM)</th>
                                <th>Height (CM)</th>
                                <th>Line Total</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            <!-- Items will be added here -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end" >Order Total:</th>
                                <th colspan="3" ><span id="txtOrderTotal" ></span></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="assets/custom.js"></script>

    </body>
</html>
