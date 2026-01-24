{extends file="layouts/main.tpl"}

{block name="content"}
<h2 class="mb-4">Orders</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        {foreach $orders as $order}
        <tr>
            <td>{$order.id}</td>
            <td>{$order.email}</td>
            <td>$ {$order.total}</td>
            <td>
                <span class="badge bg-info">{$order.status}</span>
            </td>
            <td>{$order.created_at}</td>
            <td>
                <form method="post" action="/admin/order/update" class="d-flex gap-1">
                    <input type="hidden" name="csrf" value="{$smarty.session.csrf}">
                    <input type="hidden" name="order_id" value="{$order.id}">
                    <select name="status" class="form-select form-select-sm">
                        <option>pending</option>
                        <option>processing</option>
                        <option>completed</option>
                        <option>cancelled</option>
                    </select>
                    <button class="btn btn-sm btn-success">Update</button>
                </form>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
{/block}
