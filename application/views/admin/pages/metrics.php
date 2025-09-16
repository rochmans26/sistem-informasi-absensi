<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Approach -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Metrik Performa Model</h6>
            </div>
            <div class="card-body">
                <?php if (isset($data['metrics'])): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Metrik</th>
                                    <th>KNN</th>
                                    <th>Random Forest</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Akurasi</td>
                                    <td><?php echo number_format($data['metrics']['KNN']['accuracy'] * 100, 2); ?>%</td>
                                    <td><?php echo number_format($data['metrics']['Random Forest']['accuracy'] * 100, 2); ?>%
                                    </td>
                                </tr>
                                <tr>
                                    <td>Presisi</td>
                                    <td><?php echo number_format($data['metrics']['KNN']['precision'] * 100, 2); ?>%</td>
                                    <td><?php echo number_format($data['metrics']['Random Forest']['precision'] * 100, 2); ?>%
                                    </td>
                                </tr>
                                <tr>
                                    <td>Recall</td>
                                    <td><?php echo number_format($data['metrics']['KNN']['recall'] * 100, 2); ?>%</td>
                                    <td><?php echo number_format($data['metrics']['Random Forest']['recall'] * 100, 2); ?>%
                                    </td>
                                </tr>
                                <tr>
                                    <td>F1 Score</td>
                                    <td><?php echo number_format($data['metrics']['KNN']['f1'] * 100, 2); ?>%</td>
                                    <td><?php echo number_format($data['metrics']['Random Forest']['f1'] * 100, 2); ?>%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <h4>Chart Performa</h4>
                        <div class="chart-area">
                            <canvas id="metricsChart"></canvas>
                        </div>
                    </div>


                <?php else: ?>
                    <div class="alert alert-warning">Tidak ada data metrik. Tolong coba kembali lagi.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>