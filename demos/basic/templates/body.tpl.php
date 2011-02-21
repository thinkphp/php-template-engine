<table>  
    <tr>  
        <th>Id</th>  
        <th>Name</th>  
        <th>Department</th>  
        <th>Email</th>  
    </tr>  
    <?php foreach($users_list as $user) { ?>  
    <tr>  
        <td align="center"><?php echo$user['id'];?></td>  
        <td><?php echo$user['name'];?></td>  
        <td><?php echo$user['department'];?></td>  
        <td><a href="mailto:<?php echo$user['email'];?>"><?php echo$user['email'];?></a></td>  
    </tr>  
    <?php } ?>  
</table>
