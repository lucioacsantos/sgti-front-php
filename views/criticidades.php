                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h3><i class="bi bi-pc-display"></i> Criticidades</h3>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCriticidade" onclick="resetForm()">
                                <i class="bi bi-plus-lg"></i> Nova criticidade
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nível</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($criticidades as $c): ?>
                            <tr>
                                <td><?= htmlspecialchars($c['id']) ?></td>
                                <td><?= htmlspecialchars($c['nivel']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteCriticidade(<?= $c['id'] ?>, '<?= htmlspecialchars($c['nivel']) ?>')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Criticidade -->
                <div class="modal fade" id="modalCriticidade" tabindex="-1" aria-labelledby="modalCriticidadeLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCriticidadeLabel">Nova Criticidade</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formCriticidade" method="POST" action="api/criticidades/crud.php">
                                <div class="modal-body">
                                    <div class="mb-3" id="nivelGroup">
                                        <label for="criticidadeNivel" class="form-label">Nível da Criticidade</label>
                                        <input type="text" class="form-control" id="criticidadeNivel" name="nivel" required>
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
                    function deleteCriticidade(id, nivel) {
                        if (confirm(`Tem certeza que deseja deletar a criticidade "${nivel}"?`)) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = 'api/criticidades/crud.php';

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