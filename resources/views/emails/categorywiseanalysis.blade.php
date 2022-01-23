<div>
    <table style="width:100%">
      <tr>
        <th>Category</th>
        <th>Quantity</th>
      </tr>
        @foreach($category as $x => $x_value)
            <tr style="text-align: center">
                <td>{{ $x }}</td>
                <td>{{ $x_value }}</td>
            </tr>
        @endforeach
    </table>
</div>

<style>
    table, th, td {
        border:1px solid black;
        text-align: center;
    }
</style>