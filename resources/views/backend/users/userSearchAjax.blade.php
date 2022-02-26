<tbody id="myTable">
    @foreach ($users as $key=>$user)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->contact}}</td>
        <td>
            <form action="{{route('user.destroy',$user->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <a href="#" class="fa fa-edit text-dark" title="Edit"> </a>
                <button type="submit" class="fas fa-trash btn-light float-right"  title="Delete" onclick="return confirm('Are you sure you want to delete?')" ></button>
        
            </form>
        </td>
    </tr>
    @endforeach
</tbody>