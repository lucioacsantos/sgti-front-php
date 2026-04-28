                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h3><i class="bi bi-pc-display"></i> Áreas</h3>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalArea" onclick="resetForm()">
                                <i class="bi bi-plus-lg"></i> Nova área
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($areas as $a): ?>
                            <tr>
                                <td><?= htmlspecialchars($a['id']) ?></td>
                                <td><?= htmlspecialchars($a['nome']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteArea(<?= $a['id'] ?>, '<?= htmlspecialchars($a['nome']) ?>')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Área -->
                <div class="modal fade" id="modalArea" tabindex="-1" aria-labelledby="modalAreaLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAreaLabel">Nova Área</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formArea" method="POST" action="api/areas/crud.php">
                                <div class="modal-body">
                                    <div class="mb-3" id="nomeGroup">
                                        <label for="areaNome" class="form-label">Nome da Área</label>
                                        <input type="text" class="form-control" id="areaNome" name="nome" required>
                                    </div>
                                    <div class="mb-3" id="siglaGroup">
                                        <label for="areaSigla" class="form-label">Sigla</label>
                                        <input type="text" class="form-control" id="areaSigla" name="sigla" required>
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
                    function deleteArea(id, nome) {
                        if (confirm(`Tem certeza que deseja deletar a área "${nome}"?`)) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = 'api/areas/crud.php';

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