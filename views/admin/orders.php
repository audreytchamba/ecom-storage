<div class="admin-container">
    <h1>Gestion des commandes</h1>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>N° commande</th>
                <th>Client</th>
                <th>Email</th>
                <th>Total</th>
                <th>Articles</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?= $order['id'] ?></td>
                    <td><?= Security::escape($order['full_name']) ?></td>
                    <td><?= Security::escape($order['email']) ?></td>
                    <td><?= number_format($order['total'], 2) ?> €</td>
                    <td><?= $order['items_count'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                    <td>
                        <form action="/admin/updateOrderStatus" method="POST" class="status-form">
                            <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                            <select name="status" onchange="this.form.submit()">
                                <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>En attente</option>
                                <option value="paid" <?= $order['status'] == 'paid' ? 'selected' : '' ?>>Payée</option>
                                <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : '' ?>>Expédiée</option>
                                <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>Livrée</option>
                                <option value="cancelled" <?= $order['status'] == 'cancelled' ? 'selected' : '' ?>>Annulée</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="/order/confirmation/<?= $order['id'] ?>" class="btn-small" target="_blank">Voir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>