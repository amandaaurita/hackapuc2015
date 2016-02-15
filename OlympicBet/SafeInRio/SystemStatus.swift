//
//  SystemStatus.swift
//  SafeInRio
//
//  Created by Bruno Baring on 12/Dec/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import Foundation
import UIKit

class SystemStatus
{
    /** ELEMENTOS DA ESTRUTURA PADRAO DE UM SINGLETON **/
    class var sharedInstance:SystemStatus
        {
        get
    {
        struct Singleton
        {
            static let instance = SystemStatus()
        }
        return Singleton.instance
        }
    }
    
    private init()
    {
    }
    /** FIM DA IMPLEMANTACAO PADRAO DE UM SINGLETON **/
     
     //     /* NavigationController do aplicativo */
     //    var navController:UINavigationController?
     //
     /** Aqui eu guardo as coisas que eu quero usar em todas as telas do sistema. Sempre os mesmos valores, pq é um Singleton. **/
     
     //    var pagarme_api_key = ""
     //
     //    var deliveryDistrict:String!
     //    var cliente:Cliente?
     //    var entrega:Entrega?
     //    var prod:Produto?
     //    var last_orders:[Entrega]?
     //    var produtos = [Produto]()
     //    var availableDistricts = [String]()
     //    var connection: NetworkConnect = NetworkConnect()
     //    var horarios_disponiveis  = [Produto:[String:[String]]]()
    
    let margem:CGFloat = 5.0
    let unselectedSize:CGFloat = 50
    let selectedSize:CGFloat = 100
    
    var games = [Game]()
    var user = User()
    var ranking = [User]()
    var dao = DAO()
    var currentGame = Game()
    
    
    //    var games: [String] = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p"]
    func string2nsdate(str: String) -> NSDate{
        let dateFormatter = NSDateFormatter()
        dateFormatter.dateFormat = "yyyy-MM-ddEEEEEHH:mm:ssxxx"
        dateFormatter.timeZone = NSTimeZone(abbreviation: "UTC");
        
        return dateFormatter.dateFromString(str) as NSDate!
    }
    
    func nsdate2string(date: NSDate) -> String{
        let dateFormatter = NSDateFormatter()
        dateFormatter.dateFormat = "MMM dd, yyyy, kk:mm a"
        dateFormatter.timeZone = NSTimeZone(abbreviation: "UTC");
        
        return dateFormatter.stringFromDate(date)
    }
    
    
    
}
