//
//  ViewController.swift
//  SafeInRio
//
//  Created by Amanda Aurita Araujo Fernandes on 12/11/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import UIKit

class loginViewController: UIViewController, UITextFieldDelegate {
    
    let emailField = UITextField()
    let passawordField = UITextField()
    let loginButton = UIButton()
    var logoImage = UIImageView()
    
    override func viewDidLoad() {
        super.viewDidLoad()
        //        DAO().getGames()
        
        
        //------ View-----------------
        self.view.backgroundColor = UIColor.whiteColor()
        
        
        //-------LogoImage------------
        logoImage = UIImageView(image: UIImage(named: "ol1"))
        //2000 × 1491'
        
        logoImage.frame = CGRectMake(10, 50, 300, 223.65)
        logoImage.frame.size.width = 300
        logoImage.frame.size.height = 223.65
        self.view.addSubview(logoImage)
        
        
        
        //------ Email Text field------
        
        emailField.frame = CGRectMake(0, self.view.frame.height/1.3 - 120, self.view.frame.width/1.3, self.view.frame.height/13.364)
        emailField.delegate = self
        emailField.backgroundColor = UIColor.amarelo()
        emailField.center.x = self.view.center.x
        emailField.textAlignment = NSTextAlignment.Center
        emailField.layer.cornerRadius = 10
        emailField.placeholder = "e-mail"
        emailField.clearButtonMode = UITextFieldViewMode.WhileEditing
        self.view.addSubview(emailField)
        
        //------ Passaword field------
        
        passawordField.frame = CGRectMake(0, self.view.frame.height/1.3 - 60, self.view.frame.width/1.3, self.view.frame.height/13.364)
        passawordField.delegate = self
        passawordField.backgroundColor = UIColor.amarelo()
        passawordField.secureTextEntry = true
        passawordField.center.x = self.view.center.x
        passawordField.textAlignment = NSTextAlignment.Center
        passawordField.layer.cornerRadius = 10
        passawordField.placeholder = "password"
        self.view.addSubview(passawordField)
        
        //------- Botao Logar--------
        loginButton.frame = CGRectMake(0, self.view.frame.height/1.3, self.view.frame.width/1.3, self.view.frame.height/13.364)
        loginButton.center.x = self.view.center.x
        loginButton.addTarget(self, action: "loginPressed", forControlEvents: .TouchUpInside)
        loginButton.backgroundColor = UIColor.azulBebe()
        loginButton.layer.cornerRadius = 10
        loginButton.titleLabel?.font = UIFont(name: "Avenir-Medium", size: 18)
        loginButton.setTitle("Enter", forState: .Normal)
        loginButton.setTitleColor(UIColor.whiteColor(), forState: .Normal)
        loginButton.addTarget(self, action: "changeBackgroundColor", forControlEvents: .TouchDown)
        loginButton.addTarget(self, action: "changeBackgroundColorBack", forControlEvents: .TouchCancel)
        self.view.addSubview(loginButton)
        
        
        emailField.text = "amanda@aurita.com"
        passawordField.text = "abc123"
        
    }
    
    func loginPressed()
    {
        self.loginButton.backgroundColor = UIColor.azulBebe()
                

        SystemStatus.sharedInstance.user.email = emailField.text
        SystemStatus.sharedInstance.user.password = passawordField.text
       
        
        //DAO().login()
        //DAO().getGames()
        //DAO().getRank()
        print("Ranking:\(SystemStatus.sharedInstance.ranking.count )")
       // DAO().getBets()
        
        let tabBarController = TabBar()
        let myVC1 = BetViewController()
        let myVC2 = GameViewController()
        let myVC3 = RankingVC()
        let controllers = [myVC1,myVC2, myVC3]
        tabBarController.viewControllers = controllers
        
        
        let firstImage = UIImage(named: "hp11")
        let secondImage = UIImage(named: "hp9")
        let thirdImage = UIImage(named: "hp13")
        
        myVC1.tabBarItem = UITabBarItem(
            title: "Previous Bets",
            image: firstImage,
            tag: 1)
        myVC2.tabBarItem = UITabBarItem(
            title: "Bet",
            image: secondImage,
            tag:2)
        myVC3.tabBarItem = UITabBarItem(
            title: "Ranking",
            image: thirdImage,
            tag: 3)
        
        tabBarController.selectedViewController = myVC2
        
        var appDelegate : AppDelegate
        appDelegate = UIApplication.sharedApplication().delegate as! AppDelegate
        
        appDelegate.window?.rootViewController = tabBarController

    }
    
    func changeBackgroundColor() {
        self.loginButton.backgroundColor = UIColor(red: 10/255.0, green: 30/255.0, blue: 50/255.0, alpha: 1.0)
    }
    
    func changeBackgroundColorBack() {
        self.loginButton.backgroundColor = UIColor(red: 10/255.0, green: 30/255.0, blue: 200/255.0, alpha: 1.0)
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    func textFieldShouldReturn(textField: UITextField) -> Bool {
        textField.resignFirstResponder()
        return true
    }
    
}

