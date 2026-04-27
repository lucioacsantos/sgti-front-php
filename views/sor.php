                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h3><i class="bi bi-pc-display"></i> Sistemas operacionais</h3>
                    <span class="me-3 text-muted">
                        <h4><i class="bi bi-person"></i> <?= htmlspecialchars($user['username']) ?> (<?= $user['role'] ?>)</h4>
                    </span>

                    <a href="logout.php" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSor" onclick="resetForm()">
                                <i class="bi bi-plus-lg"></i> Novo SOR
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Abreviação</th>
                                <th>Descrição</th>
                                <th>Lifecycle</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sor as $s): ?>
                            <tr>
                                <td><?= htmlspecialchars($s['id']) ?></td>
                                <td><?= htmlspecialchars($s['abreviacao']) ?></td>
                                <td><?= htmlspecialchars($s['descricao']) ?></td>
                                <td><?= htmlspecialchars($s['lifecycle']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteSor(<?= $s['id'] ?>, '<?= htmlspecialchars($s['abreviacao']) ?>')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal SOR -->
                <div class="modal fade" id="modalSor" tabindex="-1" aria-labelledby="modalSorLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalSorLabel">Novo SOR</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formSor" method="POST" action="api/sor/crud.php">
                                <div class="modal-body">
                                    <div class="mb-3" id="abreviacaoGroup">
                                        <label for="sorAbreviacao" class="form-label">Abreviação</label>
                                        <input type="text" class="form-control" id="sorAbreviacao" name="abreviacao" required>
                                    </div>
                                    <div class="mb-3" id="descricaoGroup">
                                        <label for="sorDescricao" class="form-label">Descrição</label>
                                        <input type="text" class="form-control" id="sorDescricao" name="descricao" required>
                                    </div>
                                    <div class="mb-3" id="lifecycleGroup">
                                        <label for="sorLifecycle" class="form-label">Lifecycle</label>
                                        <input type="text" class="form-control" id="sorLifecycle" name="lifecycle" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    function deleteSor(id, abreviacao) {
                        if (confirm(`Tem certeza que deseja deletar o SOR "${abreviacao}"?`)) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = 'api/sor/crud.php';

                            const idInput = document.createElement('input');
                            idInput.type = 'hidden';
                            idInput.name = 'id';
                            idInput.value = id;
                            form.appendChild(idInput);

                            const methodInput = document.createElement('input');
                            methodInput.type = 'hidden';
                            methodInput.name = '_method';
                            methodInput.value = 'DELETE';
                            form.appendChild(methodInput);

                            document.body.appendChild(form);
                            form.submit();
                        }
                    }
                </script>