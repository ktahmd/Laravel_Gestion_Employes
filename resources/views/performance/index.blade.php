@extends('layouts.master')
@section('contenu')
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01"><svg class="bi"><use xlink:href="#table"/></svg></label>
                <select class="form-select" id="inputGroupSelect01">
                  <option selected>This mounth</option>
                  <option value="1">01/2024</option>
                  <option value="2">02/2024</option>
                  <option value="3">03/2024</option>
                </select>
              </div>
        
        <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-success" style="width: 75%">75%</div>
          </div>
          <p class="">pressence : 170h </p>
          <div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-warning text-dark" style="width: 10%">10%</div>
          </div>
          <p class="">heurs supplimentaire: 27h </p>
          <div class="progress" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-danger" style="width: 1.5%">1.5%</div>
          </div>
          <p class="">abssence: 3h </p>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Buttons Example</h4>
                <p class="card-title-desc">The Buttons 
                </p>
                
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heurs debut</th>
                        <th>Heurs fin</th>
                        <th>HN</th>
                        <th>HA</th>
                        <th>HS</th>
                        <th>Total</th>
                    </tr>
                    </thead>


                    <tbody>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    <tr>
                        <td>2011/04/25</td>
                        <td>8h:00</td>
                        <td>21h:00</td>
                        <td>9h</td>
                        <td>0h</td>
                        <td>4h</td>
                        <td>13h</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<br><br>
<div></div>
@endsection