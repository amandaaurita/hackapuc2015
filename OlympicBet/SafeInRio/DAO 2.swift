//
//  DAO.swift
//  SafeInRio
//
//  Created by Bruno Baring on 12/Dec/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import Foundation


class DAO  {
    let apiUrl = "http://139.82.241.39/api"
    
    func SynchoronousRequest(requestname: String, page: String, method: String, params: String) -> NSData?{
        
        print(" ----- \(requestname) Request:")
        let request = NSMutableURLRequest(URL: NSURL(string: page)!)
        request.HTTPMethod = method
        var response:NSURLResponse? = NSURLResponse()
        let postString = params
        request.HTTPBody = postString.dataUsingEncoding(NSUTF8StringEncoding)
        let ret:NSData! = (try! NSURLConnection.sendSynchronousRequest(request, returningResponse: &response)) as NSData
        if let HTTPResponse = response as? NSHTTPURLResponse {
            let statusCode = HTTPResponse.statusCode
            if statusCode != 200 {
                print("Erro na requisicao")
            }
        }
        let responseString = NSString(data: ret, encoding: NSUTF8StringEncoding)
        print(" ===== \(requestname) Answer: \(responseString!)")
        
        return ret
        
    }
    
    func sendBet(result1: String, result2: String,participantId: Int){
        
        let page = "\(apiUrl)/bet"
        let method = "POST"
        let params = "ChosenParticipantId=\(participantId)&ChosenResult=\(result1)x\(result2)"
        //    PARAMETROS : ChosenParticipantId(INTEGER), ChosenResult(STRING)

        let ret = SynchoronousRequest("sendBet", page: page, method: method, params: params)
        
        //        print(ret)
        
        
        if ret != nil{
            let json = JSON(data: ret!)
            print(json)
        }
    }
    
    func register(){
        
        let page = "\(apiUrl)/user/register"
        let method = "POST"
        let params = "email=\(SystemStatus.sharedInstance.user.email)&password=\(SystemStatus.sharedInstance.user.password)"
        
        let ret = SynchoronousRequest("login", page: page, method: method, params: params)
        
        //        print(ret)
        
        
        if ret != nil{
            let json = JSON(data: ret!)
        }
    }
    
    func getRank(){
        
        let page = "\(apiUrl)/user/rank"
        let method = "GET"
        let params = ""
        
        let ret = SynchoronousRequest("getRank", page: page, method: method, params: params)
        
        //        print(ret)
        
        
        if ret != nil{
            let json = JSON(data: ret!)
            for var i = 0 ; i < json["Users"].count ; i++ {
                let aa = User()
                aa.name = json["Users"][i]["Name"].string!
                aa.score = json["Users"][i]["Score"].int
                aa.goldmedals = json["Users"][i]["GoldMedals"].int
                aa.silvermedals = json["Users"][i]["SilverMedals"].int
                aa.bronzemedals = json["Users"][i]["BronzeMedals"].int
                aa.id = json["Users"][i]["Id"].int
                SystemStatus.sharedInstance.ranking.append(aa)
            }
        }
        print(SystemStatus.sharedInstance.ranking.first?.name)

    }
    
    func login(){
        
        let page = "\(apiUrl)/user/login"
        let method = "POST"
        let params = "email=\(SystemStatus.sharedInstance.user.email!)&password=\(SystemStatus.sharedInstance.user.password!)"
        
        let ret = SynchoronousRequest("login", page: page, method: method, params: params)
        
               print(ret)
        
        
        if ret != nil{
            let json = JSON(data: ret!)
        }
    }
    
    func getGames(){
        
        //        let bb = Participant()
        //        bb.name = "Brazil"
        //        let aa = Game()
        //        aa.modality = "Futebol"
        //        aa.time = string2nsdate("2016-06-12")
        //        aa.participant?.append(bb)
        //        SystemStatus.sharedInstance.games.append(aa)
        //        let cc = SystemStatus.sharedInstance.games[0]
        //        print(SystemStatus.sharedInstance.games[0].participant![0].name)
        
        let page = "\(apiUrl)/game"
        let method = "GET"
        let params = ""
        let ret = SynchoronousRequest("getGames", page: page, method: method, params: params)
        
        //        print(ret)
        
        
        if ret != nil{
            let games = JSON(data: ret!)["Games"];
            print(games)
            for var i = 0; i < games.count; i++ {
                let gameModel = Game()
                gameModel.modality = games[i]["Modality"].string
                gameModel.time = SystemStatus.sharedInstance.string2nsdate(games[i]["Start"].string!)
                for var j = 0 ; j < games[i]["Participants"].count ; j++ {
                    let participantModel = Participant()
                    participantModel.name = games[i]["Participants"][j]["Name"].string!
                    participantModel.country_code = games[i]["Participants"][j]["CountryCode"].string!
                    participantModel.id = games[i]["Participants"][j]["Id"].int!
                    gameModel.participant.append(participantModel)
                }
                SystemStatus.sharedInstance.games.append(gameModel)
            }
        }
        
    }
    
    func getBets(){
        let page = "\(apiUrl)/bet"
        let method = "GET"
        let params = ""
        let ret = SynchoronousRequest("getBets", page: page, method: method, params: params)
        
        if ret != nil{
            let json = JSON(data: ret!)["Bets"];
            print(json)

            for var i = 0; i < json.count; i++ {
            
                let betModel = Bet()
                betModel.chosenResult = json[i]["ChosenResult"].string!
                betModel.medal = json[i]["Medal"].string
                
                let participantModel = Participant()
                participantModel.name = json[i]["Participant"]["Game"]["Participants"][0]["Name"].string!
                participantModel.country_code = json[i]["Participant"]["Game"]["Participants"][0]["CountryCode"].string!
                
                let participantModel2 = Participant()
                participantModel2.name = json[i]["Participant"]["Game"]["Participants"][1]["Name"].string!
                participantModel2.country_code = json[i]["Participant"]["Game"]["Participants"][1]["CountryCode"].string!
                
                if json[i]["Participant"]["Game"]["Participants"][1]["IsWinner"].bool == true {
                    betModel.participant = participantModel2
                }else{
                    betModel.participant = participantModel
                }

                
                let gameModel = Game()
                gameModel.modality = json[i]["Participant"]["Game"]["Modality"].string!
                gameModel.time = SystemStatus.sharedInstance.string2nsdate(json[i]["Participant"]["Game"]["Start"].string!)
                gameModel.participant.append(participantModel)
                gameModel.participant.append(participantModel2)
                
                
                betModel.game = gameModel
                
                SystemStatus.sharedInstance.user.bets.append(betModel)
                
            }
        }
    }
    
}