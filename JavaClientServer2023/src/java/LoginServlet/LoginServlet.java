/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package LoginServlet;

/**
 *
 * @author user
 */
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */

import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
/**
 *
 * @author qadir
 */
@WebServlet(urlPatterns = {"/LoginServlet"})
public class LoginServlet extends HttpServlet {
public static  ArrayList <String> loginServlet= new ArrayList<String>();
    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
 public static  void  inti() {
    	 loginServlet.add(("100"+"123"));
    	 loginServlet.add(("101"+"145"));
    	 loginServlet.add(("102"+"195"));
    	 loginServlet.add(("103"+"127"));
    	 

     }
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
           response.setContentType("text/html;charset=UTF-8");
           PrintWriter out = response.getWriter();

        try  { 
            inti();
            int flag=0;
            String id = request.getParameter("idField");
            String password = request.getParameter("passwordField1");
        // Dummy authentication logic 
        for(int i=0;i<loginServlet.size();i++){
           String Element = loginServlet.get(i);
        String ID = Element.substring(0, 3);
         String pass = Element.substring(3);
         if (ID.equals(id) && pass.equals(password)){
             flag=1;
       
        }}
        
        if(flag==1){
             boolean isAuthenticated =true;
        out.println(isAuthenticated ? "Permit" : "Deny");
        }
        
        if(flag==0){
            boolean isAuthenticated =false;
        out.println(isAuthenticated ? "Permit" : "Deny");
        }
        } catch(Exception e) {
         e.printStackTrace(out); // Print the full stack trace for debugging
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}