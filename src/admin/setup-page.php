<?php
$model = new \Wppool\Pizzapool\Core\PoolModel();

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center my-5">Pizza Pool Open/Close Timings:</h3>
            <form method="post" action="" id="opening-closing-form-js">
                <div class="form-group row">
                    <label for="sunday" class="col-sm-3 col-form-label text-right">Sunday</label>
                    <div class="col-sm-3">
                        <input type="text" name="sunday" class="form-control" id="sundayopen"
                               value="<?= $model->getOpenTime(1) ?>" placeholder="Start Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getCloseTime(1) ?>" id="sundayclose"
                               placeholder="End Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default" id="sundaysubmit">Update</button>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label text-right">Monday</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getOpenTime(2) ?>" id="mondayopen"
                               placeholder="Start Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getCloseTime(2) ?>" id="mondayclose"
                               placeholder="End Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default" id="mondaysubmit">Update</button>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label text-right">Tuesday</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getOpenTime(3) ?>" id="tuesdayopen"
                               placeholder="Start Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getCloseTime(3) ?>" id="tuesdayclose"
                               placeholder="End Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default" id="tuesdaysubmit">Update</button>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label text-right">Wednesday</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getOpenTime(4) ?>" id="wednesdayopen"
                               placeholder="Start Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getCloseTime(4) ?>"
                               id="wednesdayclose" placeholder="End Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default" id="wednesdaysubmit">Update</button>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label text-right">Thursday</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getOpenTime(5); ?>" id="thursdayopen"
                               placeholder="Start Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getCloseTime(5) ?>"
                               id="thursdayclose" placeholder="End Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default" id="thursdaysubmit">Update</button>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label text-right">Friday</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getOpenTime(6) ?>" id="fridayopen"
                               placeholder="Start Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getCloseTime(6) ?>" id="fridayclose"
                               placeholder="End Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default" id="fridaysubmit">Update</button>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label text-right">Saturday</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getOpenTime(7) ?>" id="saturdayopen"
                               placeholder="Start Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="<?= $model->getCloseTime(7) ?>"
                               id="saturdayclose" placeholder="End Time (12:00)">
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default" id="saturdaysubmit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center my-5">Pizza Pool Order Types:</h3>
            <table class="table table-bordered">
                <tr>
                    <th>Order Type</th>
                    <th>Fee</th>
                    <th>Fee Type</th>
                </tr>
                <?php
                $model = new \Wppool\Pizzapool\Core\PoolModel();
                $data = $model->getOrderTypes();
                foreach ($data as $d):
                    ?>
                    <tr>
                        <td><?= $d->name; ?></td>
                        <td><?= $d->amount; ?></td>
                        <td><?= $d->type; ?></td>
                        <td><a href="" class="btn btn-success">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <form action="" method="post" id="ordertypeform">
                <div class="row targetDiv" id="div0">
                    <div class="col-md-12">
                        <div id="myRepeatingFields" class="fvrduplicate">
                            <div class="row entry">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control form-control-sm name" name="name" type="text"
                                               placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input class="form-control form-control-sm amount" name="amount" type="text"
                                               placeholder="Amount">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label>Fee Type</label>
                                        <select class="form-control form-control-sm type" name="types" type="text"
                                                placeholder="Qty">
                                            <option value="">Select Fee Type</option>
                                            <option value="Fixed">Fixed</option>
                                            <option value="Percentage">Percentage</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

