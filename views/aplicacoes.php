                <div class="container mt-4">
                    <h3 class="mb-4"><i class="bi bi-layers"></i> Inventário de Aplicações</h3>
                    
                    <div class="accordion shadow-sm" id="accordionApps">
                        <?php foreach ($aplicacoes as $app): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?= $app['id'] ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#collapse<?= $app['id'] ?>" aria-expanded="false">
                                        <div class="d-flex justify-content-between w-100 pe-3">
                                            <span>
                                                <strong><?= htmlspecialchars($app['nome']) ?></strong>
                                            </span>
                                            <span class="badge bg-primary rounded-pill">
                                                <?= count($app['instancias']) ?> instâncias
                                            </span>
                                        </div>
                                    </button>
                                </h2>
                                
                                <div id="collapse<?= $app['id'] ?>" class="accordion-collapse collapse" 
                                    data-bs-parent="#accordionApps">
                                    <div class="accordion-body bg-light">
                                        <p class="text-muted small">Categoria: <?= htmlspecialchars($app['categoria'] ?? 'N/A') ?></p>
                                        
                                        <?php if (empty($app['instancias'])): ?>
                                            <div class="alert alert-warning py-2">Nenhuma instância configurada para esta aplicação.</div>
                                        <?php else: ?>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-sm bg-white border">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>Host</th>
                                                            <th>Rótulo (App)</th>
                                                            <th>Usuário</th>
                                                            <th>Path Base</th>
                                                            <th>Analista Validador</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($app['instancias'] as $inst): ?>
                                                            <tr>
                                                                <td class="fw-bold text-primary">
                                                                    <i class="bi bi-server"></i> <?= htmlspecialchars($inst['host']) ?>
                                                                </td>
                                                                <td><?= htmlspecialchars($inst['rotulo'] ?? '-') ?></td>
                                                                <td><code class="text-dark"><?= htmlspecialchars($inst['usuario'] ?? '-') ?></code></td>
                                                                <td><small class="text-muted"><?= htmlspecialchars($inst['path'] ?? '-') ?></small></td>
                                                                <td><?= htmlspecialchars($inst['validador'] ?? '-') ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>