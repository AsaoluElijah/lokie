for trustee list |
select * from trustee where user_id = user_id
json_encode() 

for those who added me as trustee
select * from user where trustee_email = trustee_email
 after getting the row
 while $row = mysqlFetch
    $id = $row[userId]
    select * from user where id = $id;
    encode this in json and return
