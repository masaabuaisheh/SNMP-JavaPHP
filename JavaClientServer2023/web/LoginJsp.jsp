<%@ page import="java.util.ArrayList" %>
<%@ page import="java.util.List" %>

<%
    List<String> userList = new ArrayList<>();
    userList.add("1234masa");
    userList.add("1355nancy");
    userList.add("1435amal");
    userList.add("1405noor");

    String name = request.getParameter("nameField");
    String password = request.getParameter("passwordField");

    int flag = 0;

    for (String user : userList) {
        String pass = user.substring(0, 4);
        String Name = user.substring(4);

        if (Name.equals(name) && pass.equals(password)) {
            flag = 1;
            break;
        }
    }

    boolean isAuthenticated = (flag == 1);
    out.println(isAuthenticated ? "Permit" : "Deny");
%>