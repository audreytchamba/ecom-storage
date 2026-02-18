<div class="profile-container">
    <h1>Mes commandes</h1>
    
    <div class="profile-tabs">
        <a href="/user/profile" class="tab">Informations</a>
        <a href="/user/orders" class="tab active">Mes commandes</a>
    </div>
    
    <div class="profile-content">
        <?php if (empty($orders)): ?>
            <p>Vous n'avez pas encore passé de commande.</p>
            <a href="/products" class="btn">Découvrir nos produits</a>
        <?php else: ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>N° commande</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?= $order['id'] ?></td>
                            <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                            <td><?= number_format($order['total'], 2) ?> €</td>
                            <td>
                                <span class="status status-<?= $order['status'] ?>">
                                    <?php
                                    $statusLabels = [
                                        'pending' => 'En attente',
                                        'paid' => 'Payée',
                                        'shipped' => 'Expédiée',
                                        'delivered' => 'Livrée',
                                        'cancelled' => 'Annulée'
                                    ];
                                    echo $statusLabels[$order['status']] ?? $order['status'];
                                    ?>
                                </span>
                            </td>
                            <td>
                                <a href="/order/confirmation/<?= $order['id'] ?>" class="btn-small">Voir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>